<?php  

namespace App\View\Components;  

use Illuminate\View\Component;  

class Alert extends Component  
{  
    public $type;  
    public $message;  
    public $details;  

    public function __construct($type, $message, $details = null)  
    {  
        $this->type = $type;  
        $this->message = $message;  
        $this->details = $details;  
    }  

    public function render()  
    {  
        return view('components.alert');  
    }  
}