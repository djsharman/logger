<?php

namespace djsharman\logger;


use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger {

    /**
     * @var LoggerInterface
     */
    private static $logger;

    /**
     * @param LoggerInterface $logger
     */
    public static function set(LoggerInterface $logger) {
        static::$logger = $logger;
    }

    /*
    public static function pauseOutput() {
        self::$logger->pauseOutput();
    }

    public static function resumeOutput($catchup = true) {
        self::$logger->resumeOutput($catchup);
    }
    */

    /**
     * @param null  $object
     * @param       $level
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function log($object = null, $level, $message, $highlight = false) {


        if (is_object($object)) {
            $className = get_class($object);
            $pid       = getmypid();
            $message   = "[{$className} {$pid}] {$message}";
        }

        if ($highlight == true) {
            $message = self::highlight($message);
        }

        if (static::$logger == null) {
            static::$logger = new ConsoleLogger();
        }

        static::$logger->log($level, $message);
    }

    private static function highlight($message) {
        $message = "\n*************\n*************\n*************\n$message\n*************\n*************\n*************\n";
        return $message;
    }

    /**
     * Outputs in Light Cyan
     *
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function alert($object = null, $message, $highlight = false) {
        static::log($object, LogLevel::ALERT, "\033[0;96m" . $message . "\033[0m", $highlight);
    }

    /**
     * Outputs in red
     *
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function critical($object = null, $message, $highlight = false) {
        //static::log($object, LogLevel::CRITICAL, $message, $context);
        static::log($object, LogLevel::DEBUG, "\033[0;31m" . $message . "\033[0m", $highlight);
    }

    /**
     * Outputs in white
     *
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function debug($object = null, $message, $highlight = false) {
        //static::log($object, LogLevel::DEBUG, $message, $highlight);
        static::log($object, LogLevel::DEBUG, "\033[0;32m" . $message . "\033[0m", $highlight);
    }

    /**
     * Outputs in yellow
     *
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function emergency($object = null, $message, $highlight = false) {

        static::log($object, LogLevel::EMERGENCY, "\033[0;33m" . $message . "\033[0m", $highlight);
    }

    /**
     * Outputs in red
     *
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function error($object = null, $message, $highlight = false) {
        //static::log($object, LogLevel::ERROR, $message, $context);
        static::log($object, LogLevel::DEBUG, "\033[1;31m" . $message . "\033[0m", $highlight);
    }

    /**
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function info($object, $message, $highlight = false) {
        //static::log($object, LogLevel::INFO, $message, $highlight);
        static::log($object, LogLevel::INFO, "\033[0;34m" . $message . "\033[0m", $highlight); //TODO added it in temporarily to see better, remove this or make it parameterized.
    }

    /**
     * @param null  $object
     * @param       $message
     *
     * @return null
     * @internal param array $context
     *
     */
    public static function notice($object = null, $message) {
        static::log($object, LogLevel::NOTICE, $message);
    }

    /**
     * @param null  $object
     * @param       $message
     * @param bool  $highlight
     *
     * @return null
     * @internal param array $context
     */
    public static function warning($object = null, $message, $highlight = false) {
        //static::log($object, LogLevel::WARNING, $message, $context);
        static::log($object, LogLevel::DEBUG, "\033[1;33m" . $message . "\033[0m", $highlight);
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct() {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone() {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup() {
    }


    public static function orangeHL($object = null, $message, $highlight = false) {
        static::log($object, LogLevel::DEBUG, "\033[38:2:0:0:0m\033[48:2:255:165:0m" . $message . "\033[0m", $highlight);
    }

    public static function peach($object = null, $message, $highlight = false) {
        static::log($object, LogLevel::DEBUG, "\e[38;5;208m" . $message . "\033[0m", $highlight);
    }
}

?>