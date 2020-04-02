var showModal = function(array, collectionID) {   
    currentItem = [];
    currentItem['ItemID'] = array['ItemID'];
    var getFullItemInfo = function() {
        $.ajax({
            url:'index.php/ViewCollection/getFullItemInfo',
            method: 'post',
            data: {
                collectionID: collectionID,
                itemID: array['ItemID']
            },
            success: function(response) {
                response = JSON.parse(response);
                currentItem['Owned'] = response['Owned'];
                currentItem['DateAdded'] = response['DateAdded'];
                
                $("#itemModal").modal('show');
                if (currentItem['Owned'] == "1") {
                    $("#buttonMarkUnowned").removeClass('d-none');
                    $("#buttonMarkOwned").addClass('d-none');
                } else {
                    $("#buttonMarkOwned").removeClass('d-none');
                    $("#buttonMarkUnowned").addClass('d-none');
                }
                $("#itemName").html(array['Name']);
                $("#itemDescription").html(array['Description']);
                $("#itemYear").html("Year: " + array['Year']);
                $("#itemCondition").html("Condition: " + array['ItemCondition']);

                if (currentItem['DateAdded'] != undefined) {
                    $("#itemDate").html("Date Acquired: " + array['DateAdded']);
                    $("#itemDate").removeClass('d-none');
                } else {
                    $("#itemDate").addClass('d-none');
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
<<<<<<< Updated upstream
    $("#itemName").html(array['Name']);
=======
    getFullItemInfo();
>>>>>>> Stashed changes
};

var changeOwned = function(id, owned) {
    var changeOwned = function() {
        $.ajax({
            url:'index.php/ViewCollection/changeOwned',
            method: 'post',
            data: {
                owned: owned,
                collectionID: id,
                itemID: currentItem['ItemID']
            },
            success: function(response) {
                response = JSON.parse(response);
                if (owned) {
                    $("#buttonMarkUnowned").removeClass('d-none');
                    $("#buttonMarkOwned").addClass('d-none');
                    $("#itemDate").html("Date Acquired: " + response);
                    $("#itemDate").removeClass('d-none');
                } else {
                    $("#buttonMarkOwned").removeClass('d-none');
                    $("#buttonMarkUnowned").addClass('d-none');
                    $("#itemDate").addClass('d-none');
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    };
    changeOwned();
}

var removeFromCollection = function(baseUrl, collectionID) {
    window.location.href = (baseUrl + "index.php?/ViewCollection/removeItem/" + collectionID + "/" + currentItem['ItemID']);
}