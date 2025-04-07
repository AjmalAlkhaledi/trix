<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdderText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:text {name}';

    protected $name = 'Adder text class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new Text class';

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
        $fullPath = $path.'/app/Src/Messages/'.$name.'.php';

        if (! preg_match('/^[A-Za-z0-9_]+$/', $name)) {
            echo 'Syntax error !';

            return 0;
        }

        if (\is_dir($fullPath) || \is_file($fullPath)) {
            echo 'Already exists !';

            return 0;
        }
        print_r(
            shell_exec('php artisan make:class Src/Messages/'.$name)
        );
        file_put_contents($fullPath, "<?php

namespace App\Src\Messages;

use App\Events\UpdateReceived;

class {$name}
{
    /**
     * Write your codes at this method
     * 
     */
    public function __construct(UpdateReceived \$event)
    {
        \$update = \$event->updates();
        \$message = \$update->message;
        \$chat_id = \$message->chat->id;
        
        ///
        
    }
}");

        return 1;

    }
}
