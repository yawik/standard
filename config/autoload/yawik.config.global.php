<?php

return array(
    'doctrine' =>
        array(
            'connection' =>
                array(
                    'odm_default' =>
                        array(
                            'connectionString' => 'mongodb://172.17.0.1:27017/YAWIK_TEST',
                        ),
                ),
            'configuration' =>
                array(
                    'odm_default' =>
                        array(
                            'default_db' => 'YAWIK_TEST',
                        ),
                ),
        ),
    'core_options' =>
        array(
            'system_message_email' => 'me@itstoni.com',
        ),
);
