/*Bật tắt form xác nhận xóa*/
const deleteOrders = document.querySelectorAll('.js-delete-order')
const modalDeleteOrder = document.querySelector('.js-modal-deleteOrder')   
const modalDeleteOrderClose = document.querySelector('.js-modal-deleteOrder-close')
const modalDeleteOrderContainer = document.querySelector('.js-modal-deleteOrder-container')
const modalDeleteOrderChooseYes = document.querySelector('.js-order-btn-yes')
const modalDeleteOrderChooseNo = document.querySelector('.js-order-btn-no')

function hideFormDeleteOrder(){
    modalDeleteOrder.classList.add('hide-form-order')
}

if(modalDeleteOrder){
    modalDeleteOrderClose.addEventListener('click', hideFormDeleteOrder)
    modalDeleteOrder.addEventListener('click', hideFormDeleteOrder)
    modalDeleteOrderContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalDeleteOrderChooseNo.addEventListener('click', hideFormDeleteOrder)
}

/*Bật tắt form order detail New*/
const ordersDetail = document.querySelectorAll('.js-detail-orderNew')
const modalOrderDetailNew = document.querySelector('.js-modal-dOrder-new')   
const modalOrderDetailNewClose = document.querySelector('.js-modal-dOrder-new-close')
const modalOrderDetailNewContainer = document.querySelector('.js-modal-dOrder-new-container')

function hideFormOrderDetail(){
    modalOrderDetailNew.classList.add('hide-form-order')
}

if(modalOrderDetailNew){
    modalOrderDetailNewClose.addEventListener('click', hideFormOrderDetail)
    modalOrderDetailNew.addEventListener('click', hideFormOrderDetail)
    modalOrderDetailNewContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
}

/*Bật tắt form confirm approve*/
const confirmApproves = document.querySelectorAll('.js-confirm-approve')
const modalConfirmApprove = document.querySelector('.js-modal-confirmApprove')   
const modalConfirmApproveClose = document.querySelector('.js-modal-confirmApprove-close')
const modalConfirmApproveContainer = document.querySelector('.js-modal-confirmApprove-container')
const modalConfirmApproveChooseYes = document.querySelector('.js-confirmApprove-btn-yes')
const modalConfirmApproveChooseNo = document.querySelector('.js-confirmApprove-btn-no')

function hideFormConfirmApprove(){
    modalConfirmApprove.classList.add('hide-form-order')
}

if(modalConfirmApprove){
    modalConfirmApproveClose.addEventListener('click', hideFormConfirmApprove)
    modalConfirmApprove.addEventListener('click', hideFormConfirmApprove)
    modalConfirmApproveContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalConfirmApproveChooseNo.addEventListener('click', hideFormConfirmApprove)
}

/*Bật tắt form order detail Deliver*/
const ordersDetailsDeliver = document.querySelectorAll('.js-detail-orderDeliver')
const modalOrderDetailDeliver = document.querySelector('.js-modal-dOrder-deliver')   
const modalOrderDetailDeliverClose = document.querySelector('.js-modal-dOrder-deliver-close')
const modalOrderDetailDeliverContainer = document.querySelector('.js-modal-dOrder-deliver-container')

function hideFormOrderDetailDeliver(){
    modalOrderDetailDeliver.classList.add('hide-form-order')
}

if(modalOrderDetailDeliver){
    modalOrderDetailDeliverClose.addEventListener('click', hideFormOrderDetailDeliver)
    modalOrderDetailDeliver.addEventListener('click', hideFormOrderDetailDeliver)
    modalOrderDetailDeliverContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
}


/*Bật tắt form confirm complete*/
const confirmCompletes = document.querySelectorAll('.js-confirm-complete')
const modalConfirmComplete = document.querySelector('.js-modal-confirmComplete')   
const modalConfirmCompleteClose = document.querySelector('.js-modal-confirmComplete-close')
const modalConfirmCompleteContainer = document.querySelector('.js-modal-confirmComplete-container')
const modalConfirmCompleteChooseYes = document.querySelector('.js-confirmComplete-btn-yes')
const modalConfirmCompleteChooseNo = document.querySelector('.js-confirmComplete-btn-no')

function hideFormConfirmComplete(){
    modalConfirmComplete.classList.add('hide-form-order')
}

if(modalConfirmComplete){
    modalConfirmCompleteClose.addEventListener('click', hideFormConfirmComplete)
    modalConfirmComplete.addEventListener('click', hideFormConfirmComplete)
    modalConfirmCompleteContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalConfirmCompleteChooseNo.addEventListener('click', hideFormConfirmComplete)
}

/*Bật tắt form complete*/
const ordersDetailsComplete = document.querySelectorAll('.js-detail-orderComplete')
const modalOrderDetailComplete = document.querySelector('.js-modal-dOrder-complete')   
const modalOrderDetailCompleteClose = document.querySelector('.js-modal-dOrder-complete-close')
const modalOrderDetailCompleteContainer = document.querySelector('.js-modal-dOrder-complete-container')

function hideFormOrderDetailComplete(){
    modalOrderDetailComplete.classList.add('hide-form-order')
}

if(modalOrderDetailComplete){
    modalOrderDetailCompleteClose.addEventListener('click', hideFormOrderDetailComplete)
    modalOrderDetailComplete.addEventListener('click', hideFormOrderDetailComplete)
    modalOrderDetailCompleteContainer.addEventListener('click', function(){
        event.stopPropagation()
})
}

/*Bật tắt form confirm cancelled New*/
const confirmCancelleds = document.querySelectorAll('.js-confirm-cancelled')
const modalConfirmCancelled = document.querySelector('.js-modal-confirmCancelled')   
const modalConfirmCancelledClose = document.querySelector('.js-modal-confirmCancelled-close')
const modalConfirmCancelledContainer = document.querySelector('.js-modal-confirmCancelled-container')
const modalConfirmCancelledChooseYes = document.querySelector('.js-confirmCancelled-btn-yes')
const modalConfirmCancelledChooseNo = document.querySelector('.js-confirmCancelled-btn-no')

function hideFormConfirmCancelled(){
    modalConfirmCancelled.classList.add('hide-form-order')
}

if(modalConfirmCancelled){
    modalConfirmCancelledClose.addEventListener('click', hideFormConfirmCancelled)
    modalConfirmCancelled.addEventListener('click', hideFormConfirmCancelled)
    modalConfirmCancelledContainer.addEventListener('click', function(){
        event.stopPropagation()
    })
    modalConfirmCancelledChooseNo.addEventListener('click', hideFormConfirmCancelled)
}