<script src="js/codebase.core.min.js"></script>
<script src="js/codebase.app.min.js"></script>
<script src="js/lib/plus.js"></script>
<script src="js/lib/one.js"></script>
<script src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="js/plugins/jquery-validation/additional-methods.js"></script>
<script src="js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="js/pages/be_forms_validation.js"></script>
<script src="js/plugins/jquery-validation/localization/messages_fr.js"></script>

@yield('script')

<script>jQuery(function(){ Codebase.helpers(['notify','content-filter','select2']); });</script>
