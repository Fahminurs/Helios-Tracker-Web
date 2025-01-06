        <!-- Contoh Penggunaan Komponen Alert Singkat -->  
        @if($alertType == 'success')
        <x-alert id="alert-short" type="{{ $alertType }}" message="{{ $alertMessage }}" style="display: none;" />  
        @elseif($alertType == 'danger') 

        <!-- Memeriksa jika ada detail untuk ditampilkan -->  
        @if(!empty($alertDetails))  
            <x-alert-detail id="alert-detail" type="{{ $alertType }}" message="{{ $alertMessage }}" :details="$alertDetails" />  
        @endif  
        @endif


            <!-- Navigation Bar -->  
    <x-navigationbar />  