/* 
    https://www.youtube.com/watch?v=jfYWwQrtzzY
    Web Dev Simplified: 'How To Build Sortable Drag & Drop With Vanilla Javascript' 
*/

const draggables = document.querySelectorAll('.draggable');
const containers = document.querySelectorAll('.container-draggable');

var position = 1;
var taskPositions = {};

draggables.forEach(draggable => {

    if (document.getElementById('sorted_by').getAttribute('data-sortedby') != 'Ascending') {
        draggable.setAttribute('draggable', false);
        draggable.classList.remove('draggable');
    }

    draggable.addEventListener('dragstart', () => {
        draggable.classList.add('dragging');
    });

    draggable.addEventListener('dragend', () => {
        draggable.classList.remove('dragging');

        position = 1;
        cards = document.querySelectorAll('.draggable');
        cards.forEach(card => {
            card.setAttribute('data-position', position.toString());
            //update position number on top left of card
            document.getElementById('p_id-'+card.getAttribute('data-id')).innerHTML = position;
            //append task ids and new positions to object to be sent via ajax { id => position }
            taskPositions[card.getAttribute('data-id')] = card.getAttribute('data-position');

            //replaces 'Current: id' with just 'id', obtained from index() of option containing 'Current'
            $('#positions-'+ card.getAttribute('data-id') +' option:contains("Current")')
                .text($('#positions-'+ card.getAttribute('data-id') +' option:contains("Current")').index());
            
            $('#positions-'+ card.getAttribute('data-id') +' option[value='+ card.getAttribute('data-position') +']')
                .prop('disabled', true)
                .prop('selected', true).text('Current: '+ card.getAttribute('data-position'))
                .siblings().removeAttr('disabled');

            position++;
        });

        ajaxUpdatePositions(taskPositions);

    });
});

containers.forEach(container => {
    container.addEventListener('dragover', e => {
        //removes do not allow cursor
        e.preventDefault()
        const afterElement = getDragAfterElement(container, e.clientY)
        const draggable = document.querySelector('.dragging')
        if (afterElement == null) {
            container.appendChild(draggable);
        } else {
            container.insertBefore(draggable, afterElement);
        }
    })
})

//y = mouse position
function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect()
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child }
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}


function ajaxUpdatePositions(taskPositions) {
    
    taskPositions['action'] = 'reposition';
    tasksJSON = taskPositions;

    $.ajax({
        url: window.location.pathname,
        type: "POST", //request type
        data: tasksJSON,
    })

}