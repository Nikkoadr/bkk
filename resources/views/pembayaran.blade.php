<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>nama</th>
                <th>nomor wa</th>
                <th>email</th>
                <th>bayar</th>
                <th>status bayar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pendaftaran -> nama }}</td>
                <td>{{ $pendaftaran -> email }}</td>
                <td>{{ $pendaftaran -> nomor_wa }}</td>
                <td>{{ $pendaftaran -> bayar }}</td>
                <td>{{ $pendaftaran -> status }}</td>
            </tr>
        </tbody>
    </table>
        <button class="btn btn-primary mt-3" id="pay-button">Bayar</button>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key={{ config('midtrans.clinet_key') }}></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '/bukti_pembayaran/{{$pendaftaran->id}}'
            console.log(result);
        },
        onPending: function(result){
            alert("wating your payment!");
            console.log(result);
        },
        onError: function(result){
            alert("payment failed!");
                console.log(result);
        },
        onClose: function () {
                    alert('you closed the popup without finishing the payment');
                }
    });
    };
</script>
</body>
</html>