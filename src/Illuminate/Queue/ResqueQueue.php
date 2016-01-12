<?php

namespace Illuminate\Queue;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Redis\Database;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Contracts\Queue\Queue as QueueContract;

class ResqueQueue extends Queue implements QueueContract
{

}
