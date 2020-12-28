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

        <h1 class="mt-4 mb-5">Connection with webcheckout</h1>

        <div class="border border-dark p-3 rounded w-75">
            <div class="row">
                <div class="col">
                    <h4 class="text-primary">Enter the data to make the payment</h4>
                    <form action="{{ route('payment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputReference">Reference</label>
                            <input type="text" name="reference" class="form-control" id="inputReference" required>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <textarea class="form-control" name="description" id="inputDescription" required></textarea>
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
                            <label for="inputTotal">Valor a pagar</label>
                            <input type="text" name="total" class="form-control" id="inputTotal" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Pagar</button>
                    </form>
                </div>
                <div class="col border-left d-flex flex-column align-items-center justify-content-around">
                    <h1 class="text-primary">Información del Pago </h1>
                    <div class="d-flex flex-column align-items-center">
                        <p class="h1 text-danger pb-3">Rechazado</p>
                        <p class="h4">Invoice number: <span class="text-secondary">01010101010</span></p>
                        <p class="h4">Referencia: <span class="text-info">53465436356</span></p>
                        <p class="h4">Valor de transacción: <span class="text-success">$10.000</span></p>
                        <p class="h4">Tiempo de expiración: <span class="text-primary">5min</span></p>
                    </div>
                    <form action="{{ route('payment') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">Retry</button>
                    </form>
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