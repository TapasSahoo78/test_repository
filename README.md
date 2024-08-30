$data = [
                    "message" => [
                        "token" => $deviceToken,
                        // "notification" => array(),
                        "data" => $notiFicationdata,
                        "android" => [
                            "priority" => "high",
                        ],
                        "apns" => [
                            "headers" => [
                                "apns-priority" => "10",
                            ],
                            "payload" => [
                                "aps" => [
                                    "content-available" => 1,
                                    "mutable-content" => 1,
                                    // 'alert' => [
                                    //     'title' => $title,
                                    //     'body' => $body,
                                    // ],
                                ]
                            ],
                        ],
                    ]
                ];

for ios silent notification.
