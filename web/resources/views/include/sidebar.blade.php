<div class="col-sm-3">
    <div class="col-sm-12 filter">
        <p class="title">Áo</p>
        <ul class="menu">
            <li><a href="#">Áo sát nách</a></li>
            <li><a href="#">Áo thun</a></li>
            <li><a href="#">Áo sơmi</a></li>
        </ul>

        <p class="title">TÌM KIẾM THEO</p>
        <form>
            <div style="margin-bottom: 10px">
                <p class="title">Màu sắc</p>
                <div class="mausac">
                    <input type="checkbox" name="mausac" id="ms-check1" value="red"/>
                    <input type="checkbox" name="mausac" id="ms-check2" value="yellow"/>
                    <input type="checkbox" name="mausac" id="ms-check3" value="green"/>
                </div>
            </div>

            <div style="margin-bottom: 10px">
                <p class="title">Kích cỡ</p>
                <div class="kichco">
                    <input type="checkbox" name="kichco" id="kc-check1"/>
                    <label for="kc-check1">S</label>
                    <input type="checkbox" name="kichco" id="kc-check2"/>
                    <label for="kc-check2">M</label>
                    <input type="checkbox" name="kichco" id="kc-check3"/>
                    <label for="kc-check3">N</label>
                </div>
            </div>

            <div style="margin-bottom: 30px">
                <p class="title">Giá</p>
                <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" readonly/>
                </p>
                <div id="slider-range"></div>
            </div>
            <p id="btnGui"><input type="submit" value="TÌM KIẾM"></p>
        </form>
    </div>
</div>