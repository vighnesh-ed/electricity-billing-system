<!DOCTYPE html>
<html>
<head>
    <title>Electricity Billing System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow-lg">

        <div class="card-header bg-primary text-white text-center">
            <h2>Electricity Billing System</h2>
        </div>

        <div class="card-body">

            <form action="bill.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Month</label>

                    <select class="form-select" name="month" required>

                        <option value="">Select Month</option>

                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>

                    </select>

                </div>

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label>Address</label>

                    <textarea class="form-control" rows="4" name="address" required></textarea>

                </div>

                <div class="mb-3">
                    <label>Mobile Number</label>

                    <input
                    type="text"
                    maxlength="10"
                    class="form-control"
                    name="mobile"
                    required>

                </div>

                <div class="mb-3">
                    <label>Units Consumed</label>

                    <input
                    type="number"
                    class="form-control"
                    name="units"
                    min="0"
                    required>

                </div>

                <button class="btn btn-success w-100">
                    Generate Bill
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>