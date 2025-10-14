document.getElementById('provinsi').addEventListener('change', function () {
    let prov = this.value;
    let kotaDropdown = document.getElementById('kota');

    if (prov) {
        fetch('get_kota.php?provinsi=' + encodeURIComponent(prov))
            .then(response => response.json())
            .then(data => {
                kotaDropdown.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                data.forEach(k => {
                    kotaDropdown.innerHTML += `<option value="${k}">${k}</option>`;
                });
                kotaDropdown.disabled = false;
            });
    } else {
        kotaDropdown.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
        kotaDropdown.disabled = true;
    }
});
