

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <button id="zureo-importer-sync-past" class="button button-primary" type="submit">Sync All (Warning!)</button>
    <form id="zureo-importer-period" method="get" action="">
        <div id="universal-message-container">
            <h2>Sincronizar Periodo</h2>
            <div class="options">
                <p>
                    <label>Fecha de inicio</label>
                    <input type="date" name="start_date" id="start_date"/>
                    <br>
                    <label>Fecha de fin</label>
                    <input type="date" name="end_date" id="end_date"/>
                </p>
            </div>
            <!-- #universal-message-container -->
            <button id="zureo-importer-sync-period" class="button button-primary" type="submit">Sync Period</button>
    </form>
</div>
<button id="zureo-importer-sync" class="button button-primary">Sync today</button>





