<div ng-controller="GalleryCTL">
  <?php include(dirname(__FILE__).'/head.php');?>
    <div>
        <form ng-submit="addSubmit()">
            <fieldset ng-disabled="isUploading">
            <div class="form-group">
                <label>Add more images</label>
                <input type="file" multiple onchange="angular.element(this).scope().parseImagesInput(this);"
                       accept="image/*">
            </div>
            <div class="form-group">
                <label></label>
                <button type="submit">Upload</button>
            </div>
            </fieldset>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>thumb</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="image in images">
            <td><input class="form-control" type="checkbox" value="{{$index}}" ng-model="image.selected"></td>
            <td><img class="img-thumb" ng-src="{{image.url}}"></td>
        </tr>
        </tbody>
    </table>
    <div>
        <button class="btn btn-danger" ng-click="removeAllSelect()">Remove All Select</button>
        <div class="text-center">
            <a href="#/" class="btn btn-info">back</a>
        </div>
    </div>
</div>
<style>
    .img-thumb {
        max-width: 64px;
        max-height: 64px;
    }
</style>
