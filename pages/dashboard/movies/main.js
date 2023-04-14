// Preview Image
var loadFile = function (event) {
    var output = document.getElementById('preview-image')
    output.src = URL.createObjectURL(event.target.files[0])
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
}

function addType() {
    var selectTag = document.getElementById("type-select")
    var selectValue = selectTag.value
    if (selectValue != 'Choisir un genre') {
        var div = document.createElement('div')
        div.setAttribute("id", selectValue + "-delete")
        div.setAttribute("class", "d-flex mb-2")

        var inputTag = document.createElement("input")

        inputTag.setAttribute("value", selectValue)
        inputTag.setAttribute("class", "form-control")
        inputTag.setAttribute("name", "types[]")
        inputTag.readOnly = true

        var deleteButton = document.createElement("button");
        deleteButton.setAttribute("class", "btn btn-danger")
        deleteButton.setAttribute("type", "button")
        deleteButton.setAttribute("onclick", "deleteType('" + selectValue + "')")


        var buttonIcon = document.createElement("i")
        buttonIcon.setAttribute("class", "uil uil-multiply")
        buttonIcon.setAttribute("style", "font-size:16px; color:white")
        deleteButton.appendChild(buttonIcon)

        div.append(inputTag, deleteButton)


        var element = document.getElementById('type-inputs')
        element.setAttribute("class", "mb-2")
        element.appendChild(div)

        var optionDelete = document.getElementById(selectValue + '-option')
        optionDelete.remove()
    }
}

function deleteType(id) {
    var removeSelect = document.getElementById(id + '-delete')
    removeSelect.remove()

    var addOption = document.createElement('option')
    addOption.setAttribute("id", id + "-option")
    addOption.setAttribute("value", id)
    addOption.innerHTML = id

    var option = document.getElementById('type-select')
    option.appendChild(addOption)

}


function addActor() {
    var selectTag = document.getElementById("actor-select")
    var selectValue = selectTag.value
    if (selectValue != 'Choisir un acteur') {
        var div = document.createElement('div')
        div.setAttribute("id", selectValue + "-delete")
        div.setAttribute("class", "d-flex mb-2")

        var inputTag = document.createElement("input")

        inputTag.setAttribute("value", selectValue)
        inputTag.setAttribute("class", "form-control")
        inputTag.setAttribute("name", "actors[]")
        inputTag.readOnly = true

        var deleteButton = document.createElement("button");
        deleteButton.setAttribute("class", "btn btn-danger")
        deleteButton.setAttribute("type", "button")
        deleteButton.setAttribute("onclick", "deleteActor('" + selectValue + "')")


        var buttonIcon = document.createElement("i")
        buttonIcon.setAttribute("class", "uil uil-multiply")
        buttonIcon.setAttribute("style", "font-size:16px; color:white")
        deleteButton.appendChild(buttonIcon)

        div.append(inputTag, deleteButton)


        var element = document.getElementById('actors-input')
        element.setAttribute("class", "mb-2")
        element.appendChild(div)


        var optionDelete = document.getElementById(selectValue.split(" ").join("-") + '-option')
        optionDelete.remove()
    }
}

function deleteActor(value) {
    var removeSelect = document.getElementById(value + '-delete')
    removeSelect.remove()

    var addOption = document.createElement('option')
    addOption.setAttribute("id", value + "-option")
    addOption.setAttribute("value", value)
    addOption.innerHTML = value

    var option = document.getElementById('actor-select')
    option.appendChild(addOption)

}


function addDirector() {
    var selectTag = document.getElementById("director-select")
    var selectValue = selectTag.value
    if (selectValue != 'Choisir un réalisateur') {
        var div = document.createElement('div')
        div.setAttribute("id", selectValue + "-delete")
        div.setAttribute("class", "d-flex mb-2")

        var inputTag = document.createElement("input")

        inputTag.setAttribute("value", selectValue)
        inputTag.setAttribute("class", "form-control")
        inputTag.setAttribute("name", "directors[]")
        inputTag.readOnly = true

        var deleteButton = document.createElement("button");
        deleteButton.setAttribute("class", "btn btn-danger")
        deleteButton.setAttribute("type", "button")
        deleteButton.setAttribute("onclick", "deleteDirector('" + selectValue + "')")


        var buttonIcon = document.createElement("i")
        buttonIcon.setAttribute("class", "uil uil-multiply")
        buttonIcon.setAttribute("style", "font-size:16px; color:white")
        deleteButton.appendChild(buttonIcon)

        div.append(inputTag, deleteButton)


        var element = document.getElementById('directors-input')
        element.setAttribute("class", "mb-2")
        element.appendChild(div)


        var optionDelete = document.getElementById(selectValue.split(" ").join("-") + '-option')
        optionDelete.remove()
    }
}

function deleteDirector(value) {
    var removeSelect = document.getElementById(value + '-delete')
    removeSelect.remove()

    var addOption = document.createElement('option')
    addOption.setAttribute("id", value + "-option")
    addOption.setAttribute("value", value)
    addOption.innerHTML = value

    var option = document.getElementById('director-select')
    option.appendChild(addOption)

}



