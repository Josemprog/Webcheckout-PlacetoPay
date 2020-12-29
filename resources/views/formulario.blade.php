<!doctype html>
<html lang="en">

<head>
    <title>Webcheckout</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <img src="https://static.placetopay.com/placetopay-logo.svg" class="attachment-0x0 size-0x0" alt=""
            loading="lazy">
        <h4 class="mb-3 text-white">Connection to the Place to Pay Webcheckout</h4>
    </nav>

    <div class="mt-3 d-flex flex-column justify-content-center align-items-center ">

        {{-- <h1 class="mt-4 mb-5">Connection with webcheckout</h1> --}}

        <div class="border border-dark p-3 mb-5 rounded w-75">
            <div class="row">
                <div class="col">
                    <h4 class="text-primary">Enter the data to make the payment</h4>
                    <form action="{{ route('payment.pay') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputReference">Reference</label>
                            <input type="text" name="reference" class="form-control" id="inputReference" required>
                            <small class="form-text text-muted">The reference can be the current
                                date</small>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea class="form-control" name="description" id="inputDescription" required></textarea>
                            <small class="form-text text-muted">Enter a short description of the
                                payment</small>
                        </div>
                        <div class="form-group">
                            <label for="inputCurrency">Currency</label>
                            <div class="form-check">
                                <input class="form-check-input" name="currency" type="checkbox" id="defaultCheck1"
                                    checked disabled required>
                                <label class="form-check-label" for="defaultCheck1">
                                    COP
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAmount">Amount</label>
                            <input type="text" name="amount" class="form-control" id="inputAmount" required>
                            <small class="form-text text-muted">The amount to be paid must be greater
                                than 10,000 Colombian pesos</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Pagar</button>
                    </form>
                </div>
                <div class="col border-left d-flex flex-column align-items-center justify-content-around">
                    <h1 class="text-primary pl-5">Information of the last payment </h1>
                    @if (isset($payment))
                    @if ($payment->status == 'REJECTED' or $payment->status == 'PENDING' )
                    <p class="h1 text-danger">{{ $payment->status }}</p>
                    @else
                    <p class="h1 text-success">{{ $payment->status }}</p>
                    @endif
                    <div class="d-flex flex-column align-items-center">
                        <p class="h4">Reference: <span class="text-info">{{ $payment->reference }}</span></p>
                        <p class="h4">Transaction value: <span
                                class="text-success">${{ number_format($payment->amount) }}</span></p>
                        <p class="h4">Description: <span class="text-info">{{ $payment->description }}</span></p>
                        @if ($payment->status == 'REJECTED' or $payment->status == 'FAILED' )
                        <form class="mt-5" action="{{ route('payment.retry', ['payment' => $payment]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg">Retry</button>
                        </form>
                        @endif
                    </div>
                    @else
                    <p class="h1 text-muted pb-3">Status</p>
                    <div class="d-flex flex-column align-items-center">
                        <p class="h4">Reference</p>
                        <p class="h4">Transaction value</p>
                        <p class="h4">Description</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>