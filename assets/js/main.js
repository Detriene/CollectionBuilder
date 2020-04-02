var currentItem;

var showModal = function(array) {
    currentItem = array;
    $("#itemModal").modal('show');
    if (array['Owned']) {
        $("#buttonItemOwned").removeClass('d-none');
    } else {
        $("#buttonItemUnowned").removeClass('d-none');
    }
    $("#itemName").html(array['Name']);
    $('#itemDesc').html(array['Description']);
    $('#year').html(array['Year']);
    $('#condition').html(array['ItemCondition']);
};

var changeOwned = function(owned) {
    console.log("set item " + currentItem['Name'] + " owned to: " + owned);
    // do ajax call here
}

var removeFromCollection = function(baseUrl, collectionID) {
    window.location.href = (baseUrl + "index.php?/ViewCollection/removeItem/" + collectionID + "/" + currentItem['ItemID']);
}