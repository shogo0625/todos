    <!-- faltpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <!-- 第1引数：日付選択させたい要素　第2引数：オプション -->
    <script>
        flatpickr(document.getElementById('due_date'), {
           locale: 'ja',
           dateFormat: "Y/m/d",
           mindate: new Date(),
        });
    </script>
