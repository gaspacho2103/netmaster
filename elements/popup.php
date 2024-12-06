<div class="popup">
        <form class="connect-form" action="../server/connection.php" method="post">
                    <h2 class="form-title">Подключение устройств</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="firstName" id="firstName" placeholder=" ">
                        <label class="form__label">Домен 1 устройства</label>
                    </div>
                    <select class="form__group" type="text" name="firstType" id="firstType">
                        <option>computer</option>
                        <option>switch</option>
                        <option>router</option>
                    </select>
                    <div class="form__group">
                        <input class="form__input" type="text" name="secondName" id="secondName" placeholder=" ">
                        <label class="form__label">Домен 2 устройства</label>
                    </div>
                    <select class="form__group" type="text" name="secondType" id="secondType">
                        <option>computer</option>
                        <option>switch</option>
                        <option>router</option>
                    </select>
                    <button type="submit" class="send-button">Соединение</button><br>
        </form>
        <form class="unconnect-form" action="../server/unconnection.php" method="post">
                    <h2 class="form-title">Отключение устройств</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="firstName" id="firstName" placeholder=" ">
                        <label class="form__label">Домен 1 устройства</label>
                    </div>
                    <select class="form__group" type="text" name="firstType" id="firstType">
                        <option>computer</option>
                        <option>switch</option>
                        <option>router</option>
                    </select>
                    <div class="form__group">
                        <input class="form__input" type="text" name="secondName" id="secondName" placeholder=" ">
                        <label class="form__label">Домен 2 устройства</label>
                    </div>
                    <select class="form__group" type="text" name="secondType" id="secondType">
                        <option>computer</option>
                        <option>switch</option>
                        <option>router</option>
                    </select>
                    <button type="submit" class="send-button">Отсоединение</button><br>
        </form>
        <form class="remove-form" action="../server/deleteObject.php" method="post">
                    <h2 class="form-title">Удаление устройств</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="name" id="name" placeholder=" ">
                        <label class="form__label">Домен устройства</label>
                    </div>
                    <button type="submit" class="send-button">Удалить</button><br>
        </form>
        <form class="create-user" action="../server/createUser.php" method="post">
                    <h2 class="form-title">Создание пользователя</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="name" id="name" placeholder=" ">
                        <label class="form__label">Домен</label>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="password" name="password" id="password" placeholder=" ">
                        <label class="form__label">Пароль</label>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="text" name="prava" id="prava" placeholder=" ">
                        <label class="form__label">Права</label>
                    </div>
                    <button type="submit" class="send-button">Создать</button><br>
        </form>
        <form class="create-switch" action="../server/createSwitch.php" method="post">
                    <h2 class="form-title">Создание коммутатора</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="name" id="name" placeholder=" ">
                        <label class="form__label">Домен</label>
                    </div>
                    <button type="submit" class="send-button">Создать</button><br>
        </form>
        <form class="create-router" action="../server/createRouter.php" method="post">
                    <h2 class="form-title">Создание роутера</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="name" id="name" placeholder=" ">
                        <label class="form__label">Домен</label>
                    </div>
                    <button type="submit" class="send-button">Создать</button><br>
        </form>
    </div>  