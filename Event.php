<?php

namespace Bonzer\Events;

use Bonzer\Events\contracts\interfaces\Event as Event_Interface;

class Event implements Event_Interface {

  /**
   * Class Instance
   *
   * @var Event
   */
  private static $_instance;

  /**
   * Holds registered events
   *
   * @var array
   */
  protected $_events = [ ];

  /**
   * Holds Listeners
   *
   * @var array
   */
  protected $_listeners = [ ];

  /**
   * --------------------------------------------------------------------------
   * Constructor
   * --------------------------------------------------------------------------
   * 
   * @param string $name
   * 
   * @Return void 
   * */
  protected function __construct() {}

  /**
   * --------------------------------------------------------------------------
   * Creates Singleton
   * --------------------------------------------------------------------------
   * 
   * @Return Event 
   * */
  public static function get_instance() {
    if ( is_null( self::$_instance ) ) {
      return self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * --------------------------------------------------------------------------
   * Fires the event
   * --------------------------------------------------------------------------
   * 
   * @param string $event
   * @param mixed $data
   * 
   * @Return array 
   * */
  public function fire( $event, $data = [ ] ) {
    $listeners = $this->_get_listeners( $event );
    if ( !$listeners ) {
      return;
    }
    $responses = [ ];
    usort($listeners, function ($a,$b){
      if ($a['priority'] == $b['priority']) {
        return 0;
      }
      return $a['priority'] > $b['priority'] ? -1: 1;
    });
    foreach ( $listeners as $listener ) {
      $response = call_user_func_array( $listener['listener'], [ $data ] );
      $responses[] = $response;
    }
    return $responses;
  }

  /**
   * --------------------------------------------------------------------------
   * Listens the event
   * --------------------------------------------------------------------------
   * 
   * @param string|array $events
   * @param \Closure $listener
   * 
   * @Return void 
   * */
  public function listen( $events, $listener, $priority = 1 ) {
    foreach ( ( array ) $events as $event ) {
      $this->_listeners[ $event ][] = [
        'listener' => $listener,
        'priority' => $priority,
      ];
    }
  }

  /**
   * --------------------------------------------------------------------------
   * Event Listeners
   * --------------------------------------------------------------------------
   * 
   * @param string $event
   * 
   * @Return array|bool
   * */
  protected function _get_listeners( $event ) {
    if ( !array_key_exists( $event, $this->_listeners ) ) {
      return FALSE;
    }
    return $this->_listeners[ $event ];
  }

}
