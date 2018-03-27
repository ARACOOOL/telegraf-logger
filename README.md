# Logger for telegraf
Helps to collects a data for telegraf. Puts the data into the log files or send to InfluxDB directly

## Usage

```php
use Neat\Profiler\Formatter;
use Neat\Profiler\Profiler;
use Neat\Profiler\Stream\FileStream;

$profiler = new Profiler('measurement_name', new FileStream(__DIR__ . '/logs', new Formatter()));
// your code

$profiler->finish();
```
