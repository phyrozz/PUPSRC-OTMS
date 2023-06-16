// This file serves as a separate JS code for handling dynamic dropdown menus on
// both the "Province" and "City" select input fields on the Sign up modal of the login pages

$(document).ready(function() {
    var citiesByProvince = {};
  
    // Load the JSON file
    $.getJSON('/ph_provinces_and_cities.json', function(data) {
        for (var i = 0; i < data.length; i++) {
            var region = data[i]['provinces'];
            for (var j = 0; j < region.length; j++) {
                var province = region[j];
                citiesByProvince[province['name']] = [];
                for (var k = 0; k < province['municipalities'].length; k++) {
                    var municipality = province['municipalities'][k];
                    citiesByProvince[province['name']].push(municipality['name']);
                }
            }
        }
    
        // Populate the province dropdown
        var provinceSelect = $("#Province");
        var citySelect = $("#City");
        
        provinceSelect.empty();
        provinceSelect.append("<option value=''>Select Province</option>");
        citySelect.empty();
        citySelect.append("<option value=''>Select City</option>");
        for (var province in citiesByProvince) {
            provinceSelect.append("<option value='" + province + "'>" + province + "</option>");
        }
    
        // Province change event
        provinceSelect.change(function() {
            var selectedProvince = $(this).val();
            citySelect.empty();
            citySelect.append("<option value=''>Select City</option>");
            if (selectedProvince && citiesByProvince[selectedProvince]) {
                var cities = citiesByProvince[selectedProvince];
            for (var i = 0; i < cities.length; i++) {
                citySelect.append("<option value='" + cities[i] + "'>" + cities[i] + "</option>");
            }
        }
      });
    });
});
  