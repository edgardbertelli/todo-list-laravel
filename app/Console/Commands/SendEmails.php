<?php

namespace App\Console\Commands;

use App\Models\User;
use DateInterval;
use DateTimeInterface;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Laravel\Prompts\confirm;

class SendEmails extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send
                            {username* : The usernames of the users.}
                            {--id=* : The IDs of the users.}
                            {--Q|--queue=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $name = $this->ask('What is your name?', 'Edgard');

        $password = $this->secret('What is your password?');

        if (is_null($password)) {
            $this->error('Please, type your password to continue.');
            die;
        }

        if ($this->confirm('Do you wish to continue?', true)) {
            foreach ($this->argument('username') as $username) {
                $this->info("{$name} is sending an e-mail to '{$username}'...");
            }
        }

    }

    /**
     * Get the isolatable ID for the command.
     */
    public function isolatableId(): string
    {
        return $this->argument('username');
    }

    /**
     * Determine when an isolation lock expires for the command.
     */
    public function isolationLockExpiresAt(): DateTimeInterface|DateInterval
    {
        return now()->addMinutes(5);
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     * 
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'username' => 'Which username should receive the mail?',
        ];
    }

    /**
     * Perform actions after the user was prompted for missing arguments.
     * 
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return void
     */
    protected function afterPromptingForMissingArguments(InputInterface $input, OutputInterface $output)
    {
        $input->setOption('queue', confirm(
            label: 'Would you like to queue the mail?',
            default: $this->option('queue')
        ));   
    }
}
