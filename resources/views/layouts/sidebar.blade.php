<!-- //////////////////////////////////////////// SIDEBAR //////////////////////////////////////////// -->
<div id="refreshsidebar" class="custom-sidebar-column">
    <div class="custom-sidebar-item custom-sidebar-active @if(!empty($tabtop) &&  $tabtop == 'alert') uk-active @endif">
        <a href="#" uk-tooltip="title: Ticket; pos: right">
            <div id="refreshSidebarAlert" class="custom-sidebar-active-icon">
                <i class="fa-light fa-bell fa-lg fa-nm"></i>
                <span class="uk-text-center badge-warning badge-lblCount">1</span>
            </div>
        </a>
    </div>
</div>

<!-- NAVBAR REFRESH -->
<script>
    $(document).ready(function(){
        function refreshSidebar() {
            $('#refreshsidebar').load(document.URL + ' #refreshsidebar > *');
        }
        setInterval(refreshSidebar, 20000);
    });
</script>
<!-- //////////////////////////////////////////// SIDEBAR //////////////////////////////////////////// -->