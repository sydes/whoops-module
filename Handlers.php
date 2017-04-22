<?php
namespace Module\Whoops;

use Sydes\Event;

class Handlers
{
    public function __construct(Event $events)
    {
        $events->on('site.found', '*', function () {
            $container = app();

            if ($container['settings']['debugLevel'] == 2) {
                $whoops = new \Whoops\Run;
                $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
                $whoops->register();

                app()['defaultErrorHandler'] = $container->protect(function (\Exception $e) {
                    throw $e;
                });
            }
        });
    }
}
