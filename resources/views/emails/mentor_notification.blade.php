 <h4>Hello, {{ optional($inbox->Mentor)->name ?? 'Nama Tidak Diketahui' }}</h4>
<p>Message: {{ $inbox->message }}</p>
<p>From: {{ $inbox->sender ?? 'Nama Tidak Diketahui' }}</p>
