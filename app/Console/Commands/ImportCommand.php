<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\House;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:houses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import houses data';

    protected function read_csv()
    {
        $this->info('Parce Data in CSV file');
        $return = [];
        if (($open = fopen(storage_path('app/public') . "/data.csv", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                if ($data[0] != "Name") {
                    $return[] = [
                        'name' => $data[0],
                        'price' => $data[1],
                        'badrooms' => $data[2],
                        'storeys' => $data[3],
                        'garages' => $data[4]
                    ];
                }
            }
            fclose($open);
        }
        return $return;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start Import');
        $data = $this->read_csv();
        $this->info('Insert Data');
        House::insert($data);
        $this->info('Done.');

        return Command::SUCCESS;
    }
}
