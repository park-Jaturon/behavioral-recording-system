// $(function () {
//     var d = new Date();
//     var toDay = d.getDate() + '/'
// + (d.getMonth() + 1) + '/'
// + (d.getFullYear() + 543);
// $("#datepicker-th").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
// dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
// monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
// monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
// $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
// }).datepicker('update', new Date());

jQuery(document).ready(function($) {
    jQuery.fn.datepicker.defaults.language = 'th';
    var d = new Date();
    var toDay = d.getDate() + '/'+ (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
 
    jQuery('#datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/M/yyyy', 
        isBuddhist: true, 
        formatDate: toDay, 
        dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
        dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
        monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
        monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
       
    }).datepicker('update', new Date());
});