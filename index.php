<!DOCTYPE html>
<html>

<head>
    <title>Dependent Dropdown Example Philippine Address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .select2-container .select2-selection--single {
            height: 35.8px;
            padding-top: 2px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        form {
            width: 100%;
            max-width: 400px;
            /* Adjust as needed */
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            margin-bottom: 5px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .social-icons a {
            color: #343a40;
            font-size: 24px;
            margin-right: 15px;
        }

        .social-icons a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <header class="mt-5 mb-5 text-center">
        <h1>Dependent Dropdown Philippine Address Using JSON</h1>
        <small>Note: Add submit button function</small>
    </header>
    <div class="container mb-5">
        <form>
            <div class="mb-3">
                <label for="regionSelect" class="col-sm-3 col-form-label">Region</label>
                <div class="col-sm-12">
                    <select id="regionSelect" onchange="loadProvinces()" class="form-select">
                        <option value="">Select Region</option>
                        <?php
                        // Read cluster.json and populate the region dropdown
                        $data = file_get_contents('cluster.json');
                        $regions = json_decode($data, true);
                        foreach ($regions as $regionCode => $region) {
                            echo "<option value='" . $regionCode . "'>" . $region['region_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="provinceSelect" class="col-sm-3 col-form-label">Province</label>
                <div class="col-sm-12">
                    <select id="provinceSelect" onchange="loadMunicipalities()" class="form-select">
                        <option value="">Select Province</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="municipalitySelect" class="col-sm-3 col-form-label">Municipality</label>
                <div class="col-sm-12">
                    <select id="municipalitySelect" onchange="loadBarangays()" class="form-select">
                        <option value="">Select Municipality</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="barangaySelect" class="col-sm-3 col-form-label">Barangay</label>
                <div class="col-sm-12">
                    <select id="barangaySelect" class="form-select">
                        <option value="">Select Barangay</option>
                    </select>
                </div>
            </div>
            <div class="mb-2">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <footer class="footer text-center">
        <div class="social-icons d-flex justify-content-center align-items-center">
            <a href="https://www.facebook.com/definitelynotkomir" class="text-decoration-none me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/_dfntlynotkomir" class="text-decoration-none me-2"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/kom.ir_/" class="text-decoration-none me-2"><i class="fab fa-instagram"></i></a>
            <!-- TikTok icon -->
            <a href="https://www.tiktok.com/@_dfntlynotkomir" class="text-decoration-none"><i class="fab bi bi-tiktok" style="font-size: 20.8px; height: 24px"></i></a>
        </div>
        <p>Follow me on social media</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#regionSelect').select2();
            $('#provinceSelect').select2();
            $('#municipalitySelect').select2();
            $('#barangaySelect').select2();
        });
    </script>
    <script>
        function loadProvinces() {
            var regionCode = $('#regionSelect').val();
            $('#provinceSelect').empty().append('<option value="">Select Province</option>');
            $('#municipalitySelect').empty().append('<option value="">Select Municipality</option>');
            $('#barangaySelect').empty().append('<option value="">Select Barangay</option>');
            if (regionCode !== "") {
                var provinceList = <?php echo json_encode($regions); ?>;
                var provinceObj = provinceList[regionCode]['province_list'];
                $.each(provinceObj, function(provinceName, municipalityList) {
                    $('#provinceSelect').append("<option value='" + provinceName + "'>" + provinceName + "</option>");
                });
            }
        }

        function loadMunicipalities() {
            var provinceName = $('#provinceSelect').val();
            $('#municipalitySelect').empty().append('<option value="">Select Municipality</option>');
            $('#barangaySelect').empty().append('<option value="">Select Barangay</option>');
            if (provinceName !== "") {
                var regionCode = $('#regionSelect').val();
                var municipalityList = <?php echo json_encode($regions); ?>;
                var municipalityObj = municipalityList[regionCode]['province_list'][provinceName]['municipality_list'];
                $.each(municipalityObj, function(municipalityName, barangayList) {
                    $('#municipalitySelect').append("<option value='" + municipalityName + "'>" + municipalityName + "</option>");
                });
            }
        }

        function loadBarangays() {
            var municipalityName = $('#municipalitySelect').val();
            $('#barangaySelect').empty().append('<option value="">Select Barangay</option>');
            if (municipalityName !== "") {
                var regionCode = $('#regionSelect').val();
                var provinceName = $('#provinceSelect').val();
                var barangayList = <?php echo json_encode($regions); ?>;
                var barangayArr = barangayList[regionCode]['province_list'][provinceName]['municipality_list'][municipalityName]['barangay_list'];
                $.each(barangayArr, function(index, barangayName) {
                    $('#barangaySelect').append("<option value='" + barangayName + "'>" + barangayName + "</option>");
                });
            }
        }
    </script>
</body>

</html>
