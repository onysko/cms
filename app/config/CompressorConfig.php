<?php
namespace samsoncms;

/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>
 * on 19.08.14 at 16:05
 */
if (!defined('EXTERNAL_CONFIG')) {
    /** Test ActiveRecord configuration for development */
    class CompressorConfig extends \samsonphp\config\Entity
    {
        public $output = '/var/www.final/cms.dev/www/';
    }
}
