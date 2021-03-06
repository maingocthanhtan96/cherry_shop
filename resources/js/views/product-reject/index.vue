<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <el-row :gutter="20" type="flex" class="tw-mb-6 tw-flex-wrap" justify="space-between">
          <el-col :xs="24" :sm="10" :md="6">
            <label>{{ $t('table.texts.filter') }}</label>
            <el-input v-model="table.listQuery.search" class="tw-w-full" :placeholder="$t('table.texts.filterPlaceholder')" />
          </el-col>
          <el-col :xs="24" :sm="14" :md="10">
            <br />
            <el-date-picker
              v-model="table.listQuery.updated_at"
              class="tw-w-full"
              type="daterange"
              :start-placeholder="$t('date.start_date')"
              :end-placeholder="$t('date.end_date')"
              :picker-options="pickerOptions"
              @change="changeDateRangePicker"
            />
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="24" class="table-responsive">
            <el-table
              v-loading="table.loading"
              class="tw-w-full"
              :data="table.list"
              :default-sort="{ prop: 'updated_at', order: 'descending' }"
              border
              fit
              highlight-current-row
              @sort-change="sortChange"
            >
              <el-table-column
                align="center"
                sortable="custom"
                prop="id"
                :label="$t('table.product_reject.id')"
                width="70px"
              >
                <template slot-scope="{ row }">
                  {{ row.id }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="total"
                prop="total"
                :label="$t('table.product_reject.total')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.total }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="price"
                prop="price"
                :label="$t('table.product_reject.price')"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.price | currency }}
                </template>
              </el-table-column>
              <el-table-column
                data-generator="note"
                prop="note"
                :label="$t('table.product_reject.note')"
                align="left"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  <p class="tw-whitespace-pre-line">{{ row.note }}</p>
                </template>
              </el-table-column>
              <el-table-column
                data-generator="product_id"
                prop="product_id"
                :label="$t('route.product')"
                align="left"
                header-align="center"
              >
                <template v-if="row.product" slot-scope="{ row }">
                  {{ row.product.name }}
                </template>
              </el-table-column>
              <el-table-column
                prop="color_id"
                :label="$t('route.color')"
                align="left"
                header-align="center"
              >
                <template v-if="row.product_detail && row.product_detail.color" slot-scope="{ row }">
                  {{ row.product_detail.color.name }}
                </template>
              </el-table-column>
              <el-table-column
                prop="size_id"
                :label="$t('route.size')"
                align="left"
                header-align="center"
              >
                <template v-if="row.product_detail && row.product_detail.size" slot-scope="{ row }">
                  {{ row.product_detail.size.name }}
                </template>
              </el-table-column>
              <!--{{$TEMPLATES_NOT_DELETE_THIS_LINE$}}-->
              <el-table-column
                data-generator="updated_at"
                prop="updated_at"
                :label="$t('date.updated_at')"
                sortable="custom"
                align="center"
                header-align="center"
              >
                <template slot-scope="{ row }">
                  {{ row.updated_at | parseTime('{y}-{m}-{d} {h}:{i}') }}
                </template>
              </el-table-column>
              <el-table-column :label="$t('table.actions')" align="center" class-name="small-padding fixed-width">
                <template slot-scope="{ row }">
                  <router-link v-permission="['edit']" :to="{ name: 'ProductRejectEdit', params: { id: row.id } }">
                    <i class="el-icon-edit el-link el-link--primary tw-mr-2" />
                  </router-link>
                  <a v-permission="['delete']" class="cursor-pointer" @click.stop="() => remove(row.id)">
                    <i class="el-icon-delete el-link el-link--danger" />
                  </a>
                </template>
              </el-table-column>
            </el-table>
            <pagination
              v-if="table.total > 0"
              :total="table.total"
              :page.sync="table.listQuery.page"
              :limit.sync="table.listQuery.limit"
              @pagination="getList"
            />
          </el-col>
        </el-row>
      </el-card>
    </el-col>
  </el-row>
</template>
<script>
import DateRangePicker from '@/plugins/mixins/date-range-picker';
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import { debounce } from '@/utils';
import ProductRejectsResource from '@/api/v1/product-reject';
const productRejectResource = new ProductRejectsResource();

export default {
  filters: {
    currency(string) {
      return Number(string).toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND',
      });
    },
  },
  components: { Pagination },
  mixins: [DateRangePicker],
  data() {
    return {
      table: {
        listQuery: {
          search: '',
          limit: 25,
          ascending: 0,
          page: 1,
          orderBy: 'updated_at',
          updated_at: [],
        },
        list: null,
        total: 0,
        loading: false,
      },
    };
  },
  watch: {
    'table.listQuery.search': debounce(function () {
      this.handleFilter();
    }, 500),
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await productRejectResource.list(this.table.listQuery);
        this.table.list = data.data;
        this.table.total = data.count;
        this.table.loading = false;
      } catch (e) {
        this.table.loading = false;
      }
    },
    handleFilter() {
      this.table.listQuery.page = 1;
      this.getList();
    },
    changeDateRangePicker(date) {
      if (date) {
        const startDate = this.parseTimeToTz(date[0]);
        const endDate = this.parseTimeToTz(date[1]);
        this.table.listQuery.updated_at = [startDate, endDate];
      } else {
        this.table.listQuery.updated_at = [];
      }
      this.handleFilter();
    },
    sortChange(data) {
      const { prop, order } = data;
      this.table.listQuery.orderBy = prop;
      this.table.listQuery.ascending = +(order === 'ascending');
      this.getList();
    },
    remove(id) {
      this.$confirm(
        this.$t('messages.delete_confirm', { attribute: this.$t('table.product_reject.id') + '#' + id }),
        this.$t('messages.warning'),
        {
          confirmButtonText: this.$t('button.ok'),
          cancelButtonClass: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }
      ).then(async () => {
        try {
          this.table.loading = true;
          await productRejectResource.destroy(id);
          const index = this.table.list.findIndex(value => value.id === id);
          this.table.list.splice(index, 1);
          this.$message({
            showClose: true,
            message: this.$t('messages.delete'),
            type: 'success',
          });
          this.table.loading = false;
        } catch (e) {
          this.table.loading = false;
        }
      });
    },
  },
};
</script>
