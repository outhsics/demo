/**
 * 插入排序
 */
function insertion_sort(A) {
  for (
    let j = 1;                     // 1
    j < A.length ;                 // N
    j++) {                         // N - 1
    const key = A[j]               // N - 1
    let i = j - 1                  // N - 1

    // 这个循环将抓到的牌插入合适的位置
    while (i >= 0 && A[i] > key) { // Mk
      A[i + 1] = A[i]              // (Mk-1)
      i--                          // (Mk-1)
    }
    A[i + 1] = key                 // N - 1

    //                   j
    // | --- 已排序 --- | ---- 未排序  ---- |
    // 每次循环结束的时候j的位置代表下一张需要排序的牌
  }
}


module.exports = insertion_sort
// 最好： O(N)
// 最坏： O(N^2)
