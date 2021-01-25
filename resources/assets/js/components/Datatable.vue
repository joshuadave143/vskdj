<script>
    export default{
        render: function (createElement) {
            return createElement(
                "table", {
                    ref: 'table'
                }, []
            )
        },
        props: ['votes'],
        data() {
            return {
                headers: [
                    {title: 'Position'},
                    {title: 'Candidate'},
                    {title: 'Voter'}
                ],
                rows: [],
                dtHandle: null
            }
        },
        watch: {
            votes(val, oldVal) {
                let vm = this;
                vm.rows = [];
                console.log(val)
                val.forEach(function (item) {
                    let row = [];
                    row.push(item.candidates.positions.description);
                    row.push(item.candidates.lastname+", "+item.candidates.firstname+" "+item.candidates.MI);
                    row.push(item.voters.name);
                    vm.rows.push(row);
                });
                vm.dtHandle.clear();
                vm.dtHandle.rows.add(vm.rows);
                vm.dtHandle.draw();
            }
        },
        mounted() {
            let vm = this;
            vm.dtHandle = $('#votes').DataTable({
                // columns: vm.headers,
                data: vm.rows,
                searching: true,
                paging: true,
                info: true
            });
            jQuery('#votes_wrapper .dataTables_filter input').addClass("form-control input-medium"); // modify table search input
            jQuery('#votes_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown

        }
    }
</script>