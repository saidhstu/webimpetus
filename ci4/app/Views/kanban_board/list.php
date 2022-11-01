<?php require_once(APPPATH . 'Views/kanban_board/list-title.php'); ?>

<div class="row flex-row flex-sm-nowrap py-3">

    <?php foreach ($tasks as $key => $values) { ?>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card bg-light">
                <div class="card-body card-body-custom">
                    <h6 class="card-title text-uppercase text-truncate py-2"><?= $key ?></h6>
                    <div class="items">
                        <?php if (count($values)) { ?>
                            <?php foreach ($values as $row) { ?>
                                <div class="card draggable shadow-sm" data-id="<?= $row['id'] ?>" data-category="<?= $key ?>" id="cd<?= $row['id'] ?>" draggable="true" ondragstart="drag(event)">
                                    <div class="card-body card-body-custom p-2">
                                        <div class="card-title">
                                            <a href="<?= "/" . $tableName . "/edit/" . $row['id']; ?>" class="lead font-weight-light">TSK-<?= $row['task_id'] ?></a>
                                        </div>
                                        <p>
                                            <?= $row['name'] ?>
                                        </p>
                                        <a href="<?= "/" . $tableName . "/edit/" . $row['id']; ?>" class="btn btn-success btn-sm mt-2">View</a>
                                    </div>
                                </div>
                                <div class="dropzone rounded" data-category="<?= $key ?>" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="dropzone rounded" data-category="<?= $key ?>" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>


<script>
    const drag = (event) => {
        event.dataTransfer.setData("text/plain", event.target.id);
        console.log("event", event);
    }

    const allowDrop = (ev) => {
        ev.preventDefault();
        if (hasClass(ev.target, "dropzone")) {
            addClass(ev.target, "droppable");
        }
        console.log("allowDrop", ev);
    }

    const clearDrop = (ev) => {
        removeClass(ev.target, "droppable");
        console.log("clearDrop", ev);
    }

    const drop = (event) => {
        event.preventDefault();
        const data = event.dataTransfer.getData("text/plain");
        const element = document.querySelector(`#${data}`);

        console.log("source", event.srcElement);
        try {
            console.log("target", event.target.getAttribute("data-category"));
            // remove the spacer content from dropzone
            event.target.removeChild(event.target.firstChild);
            // add the draggable content
            event.target.appendChild(element);
            // remove the dropzone parent
            unwrap(event.target);

        } catch (error) {
            console.warn("can't move the item to the same place")
        }
        console.log("drop", event);
        updateDropzones();

    }

    const updateDropzones = () => {
        console.log("updateDropzones");
        /* after dropping, refresh the drop target areas
          so there is a dropzone after each item
          using jQuery here for simplicity */

        var dz = $('<div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>');

        // delete old dropzones
        $('.dropzone').remove();

        // insert new dropdzone after each item   
        dz.insertAfter('.card.draggable');

        // insert new dropzone in any empty swimlanes
        $(".items:not(:has(.card.draggable))").append(dz);
    };

    // helpers
    function hasClass(target, className) {
        return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
    }

    function addClass(ele, cls) {
        if (!hasClass(ele, cls)) ele.className += " " + cls;
    }

    function removeClass(ele, cls) {
        if (hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, ' ');
        }
    }

    function unwrap(node) {
        node.replaceWith(...node.childNodes);
    }
</script>

<?php require_once(APPPATH . 'Views/common/footer.php'); ?>