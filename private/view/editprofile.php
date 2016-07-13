<?php
$this->import('/layout/header');
?>

<style>
    .labeltext{
        font-family: 'thk2d', 'Arial', sans-serif;
        color: #1957a4;

    }
    .text1{
        margin-top: 20px;
        margin-left: 100px;
        font-size: 32px;
    }
    hr{
        border: 1px solid #1957a4;
        width: 90%;
        margin-top: 0;
        float: left;
        margin-bottom: 0;
        margin-left: 100px;
    }
    .formClass {
        padding-top: 10px;
        font-size: 18px;
    }
    .formRight{
        display: inline-block;
        float: right;
    }
    .text2{
        font-size: 24px;
        padding-right: 100px;
        display: inline-block;
    }
    .text3{
        padding-right: 13px;
    }
    .divCenter{
        text-align: center;
    }
    .divImg{
        width:  300px;
        margin-top: 50px;
    }

    .divTop{
        margin-top: 50px;
    }

    .selected{
        width: 200px;
    }

    .line{
        background-image: url(<?php echo \Main\Helper\URL::absolute("/public/images/linetable.jpg")?>);
        margin-top: 0;
        width: 90%;
    }

</style>

<div class="container">
    <div class="labeltext text1">Edit Profile.</div>
    <div class="col-md-12 text1 line"></div>
    <div class="col-md-6">
        <div class="divCenter"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/mugshot.png")?>" class="divImg"></div>
    </div>
    <div class="col-md-6">
        <div class="labelText formClass divTop">
            <div class="text2">Name</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Email</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Username</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Phone Number</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Sex</div>
            <div class="formRight text2">
                <select class="form-control selected">
                    <option>------</option>
                    <option>M</option>
                    <option>F</option>
                </select>
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Birthday</div>
            <div class="formRight text2">
                <select class="form-control">
                    <option>Day</option>
                    <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
                    <option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                    <option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>
                    <option>16</option><option>17</option><option>18</option><option>19</option><option>20</option>
                    <option>21</option><option>22</option><option>23</option><option>24</option><option>25</option>
                    <option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
                </select>
            </div>
            <div class="formRight text3">
                <select class="form-control">
                    <option>Month</option>
                    <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
                    <option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                    <option>11</option><option>12</option>
                </select>
            </div>
            <div class="formRight text3">
                <select class="form-control">
                    <option>year</option>
                    <option>1995</option><option>1994</option><option>1993</option><option>1992</option><option>1991</option>
                    <option>1990</option><option>1989</option><option>1988</option><option>1987</option><option>1986</option>
                    <option>1985</option><option>1984</option><option>1983</option><option>1982</option><option>1981</option>
                    <option>1980</option>
                </select>
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Interested In</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="labelText formClass">
            <div class="text2">Identifies As</div>
            <div class="formRight text2">
                <input type="text" class="form-control selected">
            </div>
        </div>
        <div class="divCenter divTop">
            <a href="#" class="btn btn-primary submit">Submit</a>
        </div>
    </div>
</div>
<br><br>
<?php
$this->import('/layout/footer');
?>