<template>
  <el-row>
    <el-col :span="24">
      <el-card>
        <div slot="header">
          <template v-if="$route.params.id">
            {{ $t('route.member_edit') }}
          </template>
          <template v-else>
            {{ $t('route.member_create') }}
          </template>
        </div>
        <el-form ref="member" v-loading="loading.form" :model="form" :rules="rules" label-position="top">
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
          <el-form-item
            data-generator="is_block"
            :label="$t('table.member.is_block')"
            prop="is_block"
            :error="errors.is_block && errors.is_block[0]"
          >
            <el-tooltip :content="form.is_block === 0 ? 'OFF' : 'ON'" placement="top">
              <el-switch v-model="form.is_block" name="is_block" :active-value="1" :inactive-value="0" />
            </el-tooltip>
          </el-form-item>
          <el-form-item
            data-generator="phone"
            :label="$t('table.member.phone')"
            prop="phone"
            :error="errors.phone && errors.phone[0]"
          >
            <el-input
              v-model="form.phone"
              v-mask="'####.###.###'"
              name="phone"
              :placeholder="$t('table.member.phone')"
              maxlength="191"
              show-word-limit
            />
          </el-form-item>
          <!--{{$FROM_ITEM_NOT_DELETE_THIS_LINE$}}-->
          <el-form-item class="tw-flex tw-justify-end">
            <router-link v-slot="{ href, navigate }" :to="{ name: 'Member' }" custom>
              <a :href="href" class="el-button el-button--info is-plain" @click="navigate">{{ $t('button.cancel') }}</a>
            </router-link>
            <template v-if="$route.params.id">
              <el-button :loading="loading.button" type="primary" icon="el-icon-edit" @click="() => update('member')">
                {{ $t('button.update') }}
              </el-button>
            </template>
            <template v-else>
              <el-button :loading="loading.button" type="success" icon="el-icon-plus" @click="() => store('member')">
                {{ $t('button.create') }}
              </el-button>
            </template>
          </el-form-item>
        </el-form>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import GlobalForm from '@/plugins/mixins/global-form';
import MemberResource from '@/api/v1/member';
import { validURL } from '@/utils/validate';
import { VueMaskDirective } from 'v-mask';
// {{$IMPORT_COMPONENT_NOT_DELETE_THIS_LINE$}}

const memberResource = new MemberResource();

export default {
  directives: {
    mask: VueMaskDirective,
  },
  components: {
    // {{$IMPORT_COMPONENT_NAME_NOT_DELETE_THIS_LINE$}}
  },
  mixins: [GlobalForm],
  data() {
    return {
      form: {
        id: '',
        code: '',
        name: '',
        sns_link: '',
        is_block: 0,
        phone: '',
        amount: 0,
      }, // {{$$}}
      loading: {
        form: false,
        button: false,
      },
      // {{$DATA_NOT_DELETE_THIS_LINE$}}
    };
  },
  computed: {
    // not rename rules
    rules() {
      return {
        name: [
          {
            required: true,
            message: this.$t('validation.required', { attribute: this.$t('table.member.name') }),
            trigger: ['change', 'blur'],
          },
        ],
        sns_link: [
          {
            type: 'string',
            validator: (rule, value, callback) => {
              if (!value) {
                callback();
                return;
              }
              if (validURL(value)) {
                callback();
              } else {
                callback(new Error(this.$t('validation.url', { attribute: this.$t('table.member.sns_link') })));
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
        // {{$RULES_NOT_DELETE_THIS_LINE$}}
      };
    },
  },
  async created() {
    try {
      this.loading.form = true;
      const { id } = this.$route.params;
      // {{$CREATED_NOT_DELETE_THIS_LINE$}}
      if (id) {
        const {
          data: { data: member },
        } = await memberResource.get(id);
        this.form = member;
      }
      this.loading.form = false;
    } catch (e) {
      this.loading.form = false;
    }
  },
  methods: {
    store(member) {
      this.$refs[member].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.create'), {
          confirmButtonText: this.$t('button.create'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await memberResource.store(this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.create'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Member' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
    update(member) {
      this.$refs[member].validate((valid, errors) => {
        if (this.scrollToError(valid, errors)) {
          return;
        }
        this.$confirm(this.$t('common.popup.update'), {
          confirmButtonText: this.$t('button.update'),
          cancelButtonText: this.$t('button.cancel'),
          type: 'warning',
          center: true,
        }).then(async () => {
          try {
            this.loading.button = true;
            await memberResource.update(this.$route.params.id, this.form);
            this.$message({
              showClose: true,
              message: this.$t('messages.update'),
              type: 'success',
            });
            this.loading.button = false;
            await this.$router.push({ name: 'Member' });
          } catch (e) {
            this.loading.button = false;
          }
        });
      });
    },
  },
};
</script>
