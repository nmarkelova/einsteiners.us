<div class="uk-panel-callback">
    <p><strong>Обсудить проект?</strong><p>
    <p>Мы приготовили для Вас специальное предложение!</p>
    <form id="callpost" method="POST" action="/order/sand.php">
        {{ csrf_field() }}
        <input type="hidden" name="tittle" value="Форма: Заказать звонок" /> 
        <input type="hidden" name="iteration" value="@php echo rand(1001, 2999) @endphp">
        <div class="uk-line-elements">
            <div class="uk-line-padding">
                <div class="uk-line">
                    <input class="uk-input" name="personal" type="text" onClick="inputAction.call(this);inputLine.call(this);" required pattern="[А-Яа-яЁё]{2,}">
                    <label><span class="uk-icon" data-uk-icon="icon: user"></span> <i>*</i> Представьтесь, пожалуйста</label>
                    <span class="uk-border"></span>
                </div>
            </div>
            <div class="uk-toggle-sand">
                <p><strong>Как с вами связаться?</strong></p>
                <p>Например телефон, e-mail или скайп</p>
            </div>
            <div class="uk-line-padding">
                <div class="uk-line">
                    <input id="return-phone" name="phone" type="tel" class="uk-input uk-mask" onFocus="maskPhone.call(this);" onClick="inputAction.call(this);inputLine.call(this);" placeholder="+7 (9__) ___-__-__" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" autofocus="autofocus" required="required" maxlength="50">
                    <label><span class="uk-icon" data-uk-icon="icon: receiver"></span> <i>*</i> Контактный номер телефона</label>
                    <span class="uk-border"></span>
                </div>
            </div>
            <div class="uk-line-padding">
                <div class="uk-line">
                    <input class="uk-input" name="mail" type="email" onClick="inputAction.call(this);inputLine.call(this);" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required>
                    <label><span class="uk-icon" data-uk-icon="icon: mail"></span> <i>*</i> Электронная почта</label>
                    <span class="uk-border"></span>
                </div>
            </div>
            <div class="uk-line-padding">
                <div class="uk-line uk-line-textarea">
                    <textarea class="uk-input uk-textarea" name="comment" required onClick="inputAction.call(this);inputLine.call(this);"></textarea>
                    <label><span class="uk-icon" data-uk-icon="icon: commenting"></span> Расскажите немного о вашем проекте</label>
                    <span class="uk-border"></span>
                </div>
            </div>
        </div>
        <div class="uk-button">
            <input type="submit" value="Отправить">
        </div>
        <div class="uk-block-notification uk-text-center">
            Заполняя данную форму, вы даёте согласие на обработку персональных данных и принимаете условия <a class="uk-consent" href="#consent" data-uk-toggle onClick="showContent.call(this);event.preventDefault();" data-link="con-consent" data-load="consentloading" data-position="consentBody">политики конфиденциальности и соглашение об использовании сайта</a>.
        </div>
    </form>
</div>