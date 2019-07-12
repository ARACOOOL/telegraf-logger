# Logger for telegraf
Helps to collect a data for telegraf. Puts the data into log files.

## Usage

```php
use Neat\Profiler\Formatter;
use Neat\Profiler\Profiler;
use Neat\Profiler\Stream\FileStream;

$profiler = new Profiler('measurement_name', new FileStream(__DIR__ . '/logs', new Formatter()));
// your code

$profiler->finish();
```
## Telegraf input setting

https://github.com/influxdata/telegraf/tree/master/plugins/inputs/tail
