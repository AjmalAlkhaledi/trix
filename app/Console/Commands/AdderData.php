<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdderData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:data {name}';

    protected $name = 'Adder data class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new Callbacks data class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $name = $input->getArgument('name');
        $path = \getcwd();
        $fullPath = $path.'/app/Src/Callbacks/'.$name.'.php';

        if (! preg_match('/^[A-Za-z0-9_]+$/', $name)) {
            echo 'Syntax error !';

            return 0;
        }

        if (\is_dir($fullPath) || \is_file($fullPath)) {
            echo 'Already exists !';

            return 0;
        }
        print_r(
            shell_exec('php artisan make:class Src/Callbacks/'.$name)
        );

        file_put_contents($fullPath, "<?php

namespace App\Src\Callbacks;

use App\Events\UpdateReceived;


class {$name}
{
    /**
     * Write your codes at this method
     * 
     */
    public function __construct(UpdateReceived \$event)
    {
        \$callback = \$event->updates()->callback_query;
        \$message  = \$callback->message;
        \$chat_id  = \$message->chat->id;
        \$message_id = \$message->message_id;
        
        ///
        
    }
}
");

        return 1;
    }
}
