<template src="./VueCRUD.html"></template>
<script type="text/babel">
import {apiDomain} from './../config'
export default {
  created () {
      this.getVueItems(this.pagination.current_page);
  },
  data () {
    return {
      apiDomain: apiDomain,
      items: [],
    pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1
      },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newItem : {'title':'','description':''},
    fillItem : {'title':'','description':'','id':''}
    }
  },


  computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    methods : {

          getVueItems: function(page){
            this.$http.get(this.apiDomain+'/vueitems?page='+page).then((response) => {
              this.items = response.data.data.data;
              this.pagination = response.data.pagination;
            });
          },

          createItem: function(){
          		  var input = this.newItem;
          		  this.$http.post(this.apiDomain+'/vueitems',input).then((response) => {
          		    this.changePage(this.pagination.current_page);
          			this.newItem = {'title':'','description':''};
          			$("#create-item").modal('hide');
          			toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
          		  }, (response) => {
          			this.formErrors = response.data;
          	    });
          	},

            editItem: function(item){
                this.fillItem.title = item.title;
                this.fillItem.id = item.id;
                this.fillItem.description = item.description;
                $("#edit-item").modal('show');
            },

            updateItem: function(id){
             var input = this.fillItem;
             this.$http.put(this.apiDomain+'/vueitems/'+id,input).then((response) => {
                 this.changePage(this.pagination.current_page);
                 this.fillItem = {'title':'','description':'','id':''};
                 $("#edit-item").modal('hide');
                 toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
               }, (response) => {
                   this.formErrorsUpdate = response.data;
               });
           },


            deleteItem: function(item){
              this.$http.delete(this.apiDomain+'/vueitems/'+item.id).then((response) => {
                  this.changePage(this.pagination.current_page);
                  toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
              });
            },


            changePage: function (page) {
                this.pagination.current_page = page;
                this.getVueItems(page);
            }

  }
}
</script>
