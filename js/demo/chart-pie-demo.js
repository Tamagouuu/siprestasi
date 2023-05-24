// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"), '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
var ctxSiswa = document.getElementById("chartSiswa");
var ctxGuru = document.getElementById("chartGuru");

function getPrestasiSiswa() {
  $.ajax({
    type: "GET",
    url: "./getDataPrestasi.php?jenis_lomba=2",
    success: function (response) {
      let data = JSON.parse(response);
      const dataArr = [0, 0, 0, 0, 0, 0];

      for (const m in data) {
        if (data[m].ltingkat == "kota/kabupaten") {
          dataArr[0] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "provinsi") {
          dataArr[1] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "nasional") {
          dataArr[2] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "regional") {
          dataArr[3] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "internasional") {
          dataArr[4] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "lainnya") {
          dataArr[5] = data[m].jumlah_data;
        }

        new Chart(ctxSiswa, {
          type: "doughnut",
          data: {
            labels: ["Kota/Kabupaten", "Provinsi", "Nasional", "Regional", "Internasional", "Lainnya"],
            datasets: [
              {
                data: dataArr,
                backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc", "#f6c23e", "#e74a3b", "#e31c93"],
                hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf", "#f4b619", "#e02d1b", "#d91e8e"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: "#dddfeb",
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
            },
            legend: {
              display: false,
            },
            cutoutPercentage: 80,
          },
        });
      }
    },
  });
}
function getPrestasiGuru() {
  $.ajax({
    type: "GET",
    url: "./getDataPrestasi.php?jenis_lomba=1",
    success: function (response) {
      let data = JSON.parse(response);
      const dataArr = [0, 0, 0, 0, 0, 0];
      for (const m in data) {
        if (data[m].ltingkat == "kota/kabupaten") {
          dataArr[0] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "provinsi") {
          dataArr[1] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "nasional") {
          dataArr[2] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "regional") {
          dataArr[3] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "internasional") {
          dataArr[4] = data[m].jumlah_data;
        } else if (data[m].ltingkat == "lainnya") {
          dataArr[5] = data[m].jumlah_data;
        }

        new Chart(ctxGuru, {
          type: "doughnut",
          data: {
            labels: ["Kota/Kabupaten", "Provinsi", "Nasional", "Regional", "Internasional", "Lainnya"],
            datasets: [
              {
                data: dataArr,
                backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc", "#f6c23e", "#e74a3b", "#e31c93"],
                hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf", "#f4b619", "#e02d1b", "#d91e8e"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              borderColor: "#dddfeb",
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
            },
            legend: {
              display: false,
            },
            cutoutPercentage: 80,
          },
        });
      }
    },
  });
}

getPrestasiSiswa();
getPrestasiGuru();
