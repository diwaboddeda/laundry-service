<?php

namespace App\Http\Livewire;

use App\Models\Transaction; // Renamed Transaksi to Transaction
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $faker = Factory::create();

        // Count transactions by status
        $count_received = Transaction::where('status', 0)->count();   // Received
        $count_washed = Transaction::where('status', 1)->count();     // Washed
        $count_dried = Transaction::where('status', 2)->count();      // Dried
        $count_ironed = Transaction::where('status', 3)->count();     // Ironed
        $count_waiting_payment = Transaction::where('status', 4)->count(); // Waiting for Payment
        $count_completed = Transaction::where('status', 5)->count();  // Completed

        // Get the last 5 completed transactions
        $completed_transactions = Transaction::latest()->limit(5)->where('status', 5)->get();

        // Data for completed transactions, grouped by day
        $completed_data = Transaction::select(DB::raw('DATE_FORMAT(pickup_date, "%d") as day'), DB::raw('count(DATE_FORMAT(pickup_date, "%d %m %y")) as count'))
            ->groupBy('day')
            ->where('status', 5)
            ->get();

        // Initialize an array for new data
        $new_data = [];
        for ($i = 0; $i < now()->day; $i++) {
            $found = false;
            foreach ($completed_data as $data) {
                if ($i + 1 == $data->day) {
                    $new_data[$i + 1] = $data->count;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $new_data[$i + 1] = 0;
            }
        }

        // Create a new chart with the data
        $chart = new ColumnChartModel();
        foreach ($new_data as $day => $count) {
            $chart->addColumn($day, $count, $faker->hexColor());
        }

        // Customize chart appearance
        $chart
            ->withoutLegend()
            ->withDataLabels()
            ->setAnimated(true);

        // Return the view with the necessary data
        return view('livewire.dashboard', compact(
            'count_received', 
            'count_washed', 
            'count_dried', 
            'count_ironed',
            'count_waiting_payment', 
            'count_completed', 
            'completed_transactions', 
            'chart'
        ));
    }
}
