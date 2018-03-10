<?php

namespace Bonzer\Events\contracts\interfaces;

interface Event {

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
  public function fire( $event, $data );

  /**
   * --------------------------------------------------------------------------
   * Listens the event
   * --------------------------------------------------------------------------
   * 
   * @param string|array $event/$events
   * @param \Closure $callback
   * 
   * @Return void 
   * */
  public function listen( $event, $callback );

}
