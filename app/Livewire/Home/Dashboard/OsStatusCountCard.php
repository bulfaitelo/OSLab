<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Configuracao\Os\OsStatus;
use App\Models\Os\Os;
use Livewire\Component;

class OsStatusCountCard extends Component
{
    public $status_id;

    public function render()
    {
        if ($this->status_id) {
            setUserConfig('user_dashborard_status_id', $this->status_id);
        }
        $this->status_id = getUserConfig('user_dashborard_status_id');

        $status = OsStatus::orderBy('name')->pluck('name', 'id');

        $osCount = Os::where('status_id', $this->status_id)->count();

        return view('livewire.home.dashboard.os-status-count-card', [
            'status' => $status,
            'status_selected' => $this->status_id,
            'os_count' => $osCount,
        ]);
    }
}
