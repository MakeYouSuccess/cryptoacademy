<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Curl\Curl;
use \Curl\MultiCurl;

class EvolCampus {

    const API_URL = 'https://api.evolcampus.com/api/v1';
    const CLIENT_ID = 10050;
    const KEY = 'Hdt56.Fvlgp97';
    private $courses = [
        "5" => "Curso de Behrigner Neutron por HD Substance",
        "9" => "Curso de Arturia Synthi V",
        "10" => "Composición Musical aplicada a la Producción",
        "11" => "Curso de Ableton Live Avanzado por Groof",
        "13" => "Curso de Ableton Push 2",
        "14" => "Curso de Arturia Pigments por HD Substance",
        "15" => "Curso de Arturia Buchla Easel",
        "16" => "Curso de Ableton Live Iniciación por Hd Substance",
        "17" => "Curso de Arturia  Beatstep Pro",
        "18" => "Curso de Elektron Digitakt ",
        "19" => "Curso de Elektron Digitone",
        "20" => "Curso de FL Studio Iniciación",
        "21" => "Curso de Producción de Bases de Trap",
        "22" => "Diploma de Producción Musical y Sonido. ONLINE",
        "33" => "Diploma de Producción Musical y Sonido Semi-Presencial",
        "34" => "Diploma producción musical y sonido online (Bloque 1 + 2)", //
        "35" => "Diploma de Producción Musical y Sonido Online",
        "36" => "Diploma de Producción Musical y Sonido Semi-Presencial",
    ];

    function getToken() {
        $curl = new Curl();
        $curl->post(self::API_URL . '/token', [
            'clientid' => self::CLIENT_ID,
            'key' => self::KEY,
        ]);
        if ($curl->response->token) return $curl->response->token;
        return -1;
    }

    function getEnrollments($existing_evol) {
        $token = $this->getToken();
        if ($token == -1) {
            return [
                'success' => false,
                'message' => 'Could not connect to EvolCampus Api, Please check credentials',
            ];
        }
        $clients = [];

        $today = date('Y-m-d');

        $curl = new Curl();
        $curl->disableTimeout();
        $curl->setHeader('Authorization', 'Bearer ' . $token);
        $curl->post(self::API_URL . '/getEnrollments', [
            'page' => 1,
            'regs_per_page' => 1000,
        ]);

        if ($curl->response->page) {

            $pages = $curl->response->pages;
            $data = $curl->response->data;
            foreach($data as $enrol_item) {
                if ($existing_evol[intval($enrol_item->person->enrollmentid)] != 1) {
                    $person = $enrol_item->person;
                    $enroll = (array)$enrol_item->enroll;
                    $cid = array_search($enroll['study'], $this->courses);
                    $enroll['courseid'] = $cid ? intval($cid) : 0;
                    $enroll['enrollmentid'] = $person->enrollmentid;
                    if ($enroll['end'] > $today && $cid) {
                        if ($clients[$person->userid]) {
                            array_push($clients[$person->userid]['enroll'], (array)$enroll);
                        } else {
                            $clients[$person->userid] = (array)$person;
                            $clients[$person->userid]['enroll'] = array();
                            array_push($clients[$person->userid]['enroll'], (array)$enroll);
                        }
                    }
                }
            }

            $multi_curl = new MultiCurl();
            $multi_curl->setConcurrency(30);
            $multi_curl->disableTimeout();

            $multi_curl->success(function($instance) use (&$clients, $existing_evol) {
                $data = $instance->response->data;

                $today = date('Y-m-d');
                foreach($data as $enrol_item) {
                    if ($existing_evol[intval($enrol_item->person->enrollmentid)] != 1) {
                        $person = $enrol_item->person;
                        $enroll = (array)$enrol_item->enroll;
                        $cid = array_search($enroll['study'], $this->courses);
                        $enroll['courseid'] = $cid ? intval($cid) : 0;
                        $enroll['enrollmentid'] = $person->enrollmentid;
                        if ($enroll['end'] > $today && $cid) {
                            if ($clients[$person->userid]) {
                                array_push($clients[$person->userid]['enroll'], (array)$enroll);
                            } else {
                                $clients[$person->userid] = (array)$person;
                                $clients[$person->userid]['enroll'] = array();
                                array_push($clients[$person->userid]['enroll'], (array)$enroll);
                            }
                        }
                    }
                }
            });
            $multi_curl->error(function ($instance) {
            });

            $multi_curl->setHeader('Authorization', 'Bearer ' . $token);
            for ($i = 2; $i <= $pages; $i++) {
                $multi_curl->addPost(self::API_URL . '/getEnrollments', [
                    'page' => $i,
                    'regs_per_page' => 1000,
                ]);
            }

            $multi_curl->start();

            return $clients;

        } else {
            return [];
        }
    }
}
