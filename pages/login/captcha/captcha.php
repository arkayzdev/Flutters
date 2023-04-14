<style>
    #captcha_full_puzzle div img{padding:0;}
    #captcha_full_puzzle {}
</style>

<!-- Ccaptcha Button -->
<button id="captcha_button" type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#captcha_modal" onclick="shuffle_captcha()">CAPTCHA</button>
<!-- Captcha Modal -->
<div id="captcha_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="captcha_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Captcha Header -->
            <div class="modal-header">
                <h5 class="modal-title">Captcha</h5>
                <p style="font-size:0.75em; font-weight: 400;margin:1.5em 0 0 0;">Cliquez sur deux pièces pour échanger leurs places</p>
            </div>
            <!-- Captcha Body -->
            <div id="captcha_full_puzzle" class="modal-body">
                <!-- 1st row -->
                <div class="d-flex row">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="1">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="2">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="3">
                </div>
                <!-- 2st row -->
                <div class="d-flex row">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="4">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="5">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="6">
                </div>
                <!-- 3st row -->
                <div class="d-flex row">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="7">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="8">
                    <img class="col-4" onclick="captcha(this.id)" src="" id="9">
                </div>
            </div>
            <!-- Captcha Footer -->
            <div id="captcha_footer" class="modal-footer" style="display:none">
                <p style="color: green;">Captcha complété. Vous pouvez maintenant fermer le pop-up.</p>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
            <!-- Captcha random generator -->
            <p id="captcha_files" class="d-none"></p>
        </div>
    </div>
</div>

<!-- vérification de input $_POST["captcha_check"] et je laisse passer -->

<!-- <script src="captcha.js"></script> -->