# Events Manager
Responsible for implementing Event System in your application

## Getting Started

### Prerequisites
<ul>
  <li>PHP >= 5.4</li>
  <li>"bonzer/exceptions" : "dev-master"</li>
</ul>

### Installing 
It can be installed via composer. Run
```
composer require bonzer/events
```

## Usage
```
use Bonzer\Events\Event;
$Event = Event::get_instance();
```
for event firing, use <code>fire</code> method as:
```
use Bonzer\Events\Event;
$Event->fire('my_event', []);
```

for listening events firing, use <code>listen</code> method as:
```
use Bonzer\Events\Event;
$Event->listen('my_event', function(){
  // Callback that gets called when my_event is fired
});
```
the blueprints of both of these methods can be found at <code>src/contracts/interfaces/Event.php</code>

## Support
If you are having issues, please let me know.<br>
You can contact me at ralhan.paras@gmail.com

## License
The project is licensed under the MIT license.