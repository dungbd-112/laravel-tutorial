export type Role = 'Admin' | 'User'

export type UserRoleType = {
  [key in Role]: number
}
