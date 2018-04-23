// 哨兵
const SENTINEL = Number.MAX_SAFE_INTEGER

// 合并排序拆分子问题的方法，就是简单的从中间分开
function divide( p, r){
  return Math.floor((p + r) / 2)
}


// 治：就是将两个已经排序的数组合二为一
// conquer([1,3,2,4], 0, 2, 4) = [1,2,3,4]
function conquer(A, p, q, r){
  const A1 = A.slice(p, q)
  const A2 = A.slice(q, r)



  // 利用哨兵减少i,j指针处理到程序末尾时需要做的判断
  A1.push(SENTINEL)
  A2.push(SENTINEL)

  for(let k = p, i = 0, j = 0;   k < r;   k++) {
    A[k] = A1[i] < A2[j] ? A1[i++] : A2[j++]

    // 循环不变式： 在每次循环结尾的时候i,j,k如下
    // i : 指向A1下一个需要合并进原数组的值
    // j : 指向A2下一个需要合并进原数组的值
    // k : 指向最后一个写入原数组A的位置
  }
}


// p-r =>  p-q q+1-r
function merge_sort(A, p = 0, r, l) {

  // 兼容输入，当用户没有传入r的时候，让程序可以兼容
  r = r || A.length
  if(r - p === 1) { return }
  if(r - p === 2) {
    if( A[p] > A[r-1] ){
      [A[p], A[r-1]] = [A[r-1], A[p]]
    }
    return
  }

  // 找到拆分的位置q
  const q = divide(p, r)

  // 将数组p-r从q位置拆分成为两个，然后分别执行merge_sort
  merge_sort(A, p, q, l+1)
  merge_sort(A, q, r, l+1)

  // 合并上面两次排序的结果
  conquer(A, p, q, r)
}

module.exports = merge_sort