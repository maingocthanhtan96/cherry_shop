<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          {{ $t('route.product_sold') }}
        </div>
        <el-form ref="product" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
          <el-row :gutter="10">
            <el-col :span="12">
              <el-form-item
                :label="$t('route.member')"
                prop="member_id"
                :error="errors.member_id && errors.member_id[0]"
              >
                <el-select
                  v-model="form.member_id"
                  name="member_id"
                  filterable
                  :placeholder="$t('route.size')"
                  class="tw-w-full"
                >
                  <el-option
                    v-for="(item, index) in memberList"
                    :key="'size_' + index"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-button
                type="success"
                icon="el-icon-plus"
                style="margin-top: 4.5rem"
                @click="memberVisible = true"
              ></el-button>
            </el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col :span="6">
              <el-form-item
                data-generator="size_id"
                :label="$t('route.size')"
                prop="size_id"
                :error="errors.size_id && errors.size_id[0]"
              >
                <el-select
                  v-model="form.size_id"
                  name="size_id"
                  filterable
                  :placeholder="$t('route.size')"
                  class="tw-w-full"
                >
                  <el-option
                    v-for="(item, index) in sizeList"
                    :key="'size_' + index"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item
                data-generator="color_id"
                :label="$t('route.color')"
                prop="color_id"
                :error="errors.color_id && errors.color_id[0]"
              >
                <el-select
                  v-model="form.color_id"
                  name="color_id"
                  filterable
                  :placeholder="$t('route.color')"
                  class="tw-w-full"
                >
                  <el-option
                    v-for="(item, index) in colorList"
                    :key="'color_' + index"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="6">
              <el-form-item
                data-generator="amount"
                :label="$t('table.product_detail.amount')"
                prop="amount"
                :error="errors.amount && errors.amount[0]"
              >
                <el-input-number
                  v-model="form.amount"
                  name="amount"
                  class="tw-w-full"
                  :placeholder="$t('table.product_detail.amount')"
                />
              </el-form-item>
            </el-col>
          </el-row>
        </el-form>
      </el-card>
    </el-col>
    <el-dialog title="Tips" :visible.sync="memberVisible" width="50%">
      <el-form ref="member" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
        <el-row :gutter="10">
          <el-col :span="12">
            <el-form-item
              data-generator="code"
              :label="$t('table.member.code')"
              prop="code"
              :error="errors.code && errors.code[0]"
            >
              <el-input
                v-model="form.code"
                name="code"
                :placeholder="$t('table.member.code')"
                maxlength="191"
                show-word-limit
              />
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item
              data-generator="name"
              :label="$t('table.member.name')"
              prop="name"
              :error="errors.name && errors.name[0]"
            >
              <el-input
                v-model="form.name"
                name="name"
                :placeholder="$t('table.member.name')"
                maxlength="191"
                show-word-limit
              />
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item
              data-generator="sns_link"
              :label="$t('table.member.sns_link')"
              prop="sns_link"
              :error="errors.sns_link && errors.sns_link[0]"
            >
              <el-input
                v-model="form.sns_link"
                name="sns_link"
                :placeholder="$t('table.member.sns_link')"
                maxlength="191"
                show-word-limit
              />
            </el-form-item>
          </el-col>
          <el-col :span="12"></el-col>
        </el-row>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="memberVisible = false">Cancel</el-button>
        <el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
      </span>
    </el-dialog>
  </el-row>
</template>

<script>
import ColorResource from '@/api/v1/color';
import SizeResource from '@/api/v1/size';

const sizeResource = new SizeResource();
const colorResource = new ColorResource();
export default {
  data() {
    return {
      loading: {
        form: false,
        button: false,
      },
      form: {
        color_id: '',
        size_id: '',
        member_id: '',
        total: 0,
        note: '',
      },
      colorList: [],
      sizeList: [],
      memberList: [],
      memberVisible: false,
    };
  },
  computed: {
    rules() {
      return {};
    },
  },
  async created() {
    const {
      data: { data: color },
    } = await colorResource.getColor();
    this.colorList = color;
    const {
      data: { data: size },
    } = await sizeResource.getSize();
    this.sizeList = size;
  },
};
</script>
