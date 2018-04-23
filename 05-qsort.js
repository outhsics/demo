// 交换数组中 i,j位置元素的值
function swap(A, i, j) {
  [A[i],A[j]] = [A[j],A[i]]
}

// 拆分
function divide(A, p, r){

  // 选择最后一项为支点
  const x = A[r-1]

  let i = p - 1
  for(let j = p; j < r - 1; j++) {
    if(A[j] < x) {
      i++
      swap(A, i, j)
    }

    // |---小于支点---|--大于支点--|--未处理--|
    // 循环不变式: 将数组分成上面的3个部分，每次循环结束
    // i,j满足这样的条件： j指下一个未处理的值，i指向最后
    // 一个小于支点的值。
    // 在循环执行结束的时候，j指向下一个未排序的
  }
  swap(A, i+1, r-1)

  return i+1
}

// 排序主程序
function qsort(A, p = 0, r){

  // 兼容输入，在用户没有输入r的情况下默认r为数组长度
  r = typeof r !== 'undefined' ? r : A.length

  if(p < r - 1) { // 判断终止条件，既子问题至少两项才继续
    const q = divide(A, p, r)
    qsort(A, p, q)
    qsort(A, q + 1, r)
  }
}


module.exports = qsort




