# Philippine Address Dependent Dropdown using JSON file

![image](https://github.com/arkeensalvador/ph-address-dropdown/assets/99806440/a95e7d7f-afb9-4a8d-a47d-596c0a6d8625)

### Requirements:
- XAMPP
https://www.apachefriends.org/download.html

- Jquery
```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
```
- Select2
```html
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
```
- Bootstrap 5
```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

- HTML Tags
```html
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
```
- Javascript
```html
<script>
        $(document).ready(function() {
            $('#regionSelect').select2();
            $('#provinceSelect').select2();
            $('#municipalitySelect').select2();
            $('#barangaySelect').select2();
        });
    </script>
```
```html
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
```
### Full Code:
#### PHP
https://github.com/arkeensalvador/ph-address-dropdown/blob/main/index.php
#### JSON
https://github.com/arkeensalvador/ph-address-dropdown/blob/main/cluster.json
<hr>
<a href="https://www.buymeacoffee.com/devKom" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-violet.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>
